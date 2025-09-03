<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use App\Models\SpatieRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App install command';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $confirm = strtoupper($this->ask("❗ Tüm veritabanı sililerek tekrar kurulum yapılacak. Bu işlemin geri dönüşü yoktur. Devam Edisin mi? (E/H)", 'H'));

        if ($confirm !== 'E') {
            $this->warn("İşlem iptal edildi.");
            return Command::SUCCESS;
        }

        $this->info("Veritabanı tabloları oluşturuluyor...");

        try {
            Artisan::call('migrate:fresh', ['--force' => true]);
            $this->info(Artisan::output());
        } catch (Exception $e) {
            $this->error("Migrate işlemi sırasında bir hata oluştu: " . $e->getMessage());
            $this->warn("Geri alınıyor: migrate:rollback...");
            Artisan::call('migrate:rollback', ['--force' => true]);
            //$this->info(Artisan::output());
            return 1;
        }

        $this->info("Veritabanı tabloları olşturuldu.");

        $this->info("Super admin kullanıcısı bilgileri...");

        do {
            $adminName = $this->ask('Super admin adı?', 'Admin');
            $adminEmail = $this->ask('Super admin email?', 'superadmin@localhost.com');
            $adminPassword = $this->secret('Super admin şifresi?');

            $validator = Validator::make([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => $adminPassword,
            ], [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                $this->error("Girdiğiniz bilgilerde hata var:");
                foreach ($validator->errors()->all() as $error) {
                    $this->error("- " . $error);
                }
                $this->warn("Lütfen bilgileri tekrar giriniz.\n");
            }
        } while ($validator->fails());
        
        $admin_user = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => Hash::make($adminPassword),
            'is_admin' => true,
            'user_type' => 'admin',
            'is_active' => true,
            'approval_status' => 1
        ]);

        $super_admin_role = SpatieRole::create([
            'name' => 'super-admin',
            'view_name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $admin_user->assignRole($super_admin_role->id);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $this->info("Super admin kullanıcı oluşturuldu. ID: {$admin_user->id}");

        Artisan::call('app:create-default-content-types');
        $this->info(Artisan::output());

        Artisan::call('app:create-default-permissions');
        $this->info(Artisan::output());

        Artisan::call('app:create-content-permissions');
        $this->info(Artisan::output());

        $this->info("Ülkeler ve şehirler veritabanına ekleniyor.");
        Artisan::call('app:create-content-permissions');
        $this->info(Artisan::output());

        $this->info('Kurulum tamamlandi');
        return 0;


    }
}
