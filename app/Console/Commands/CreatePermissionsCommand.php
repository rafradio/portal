<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('Установка полномочий...');

        // Устанавливает полномочия
        $this->createPolicyPermissions();
        
        $this->info('Полномочия установлены');
    }
    
    private function createPolicyPermissions(): void
    {
        // Начальный ID для разрешений
        $permissionId = 1001;
        $policies = Gate::policies();
        $currentTime = Carbon::now();

        foreach ($policies as $model => $policy) {
            if (class_exists($policy)) {
                $methods = $this->getPolicyMethods($policy);
                $policyNames = $this->getPolicyNames($policy);

                foreach ($methods as $method) {
                    $permissionName = $policyNames[$method] ?? $method;

                    Permission::query()->insert([
                        'id' => $permissionId,
                        'created_at' => $currentTime,
                        'updated_at' => $currentTime,
                        'name' => $permissionName,
                        'action' => $method,
                        'model' => $model,
                    ]);

                    $permissionId++;

                }
            }
        }
    }
    
    private function getPolicyMethods(string $policy)
    {
        $methods = get_class_methods($policy);

        return array_filter($methods, function (string $method) {
            return !in_array($method, [
                'denyWithStatus',
                'denyAsNotFound',
            ]);
        });
    }

    private function getPolicyNames(string $policy): array
    {
        $reflection = new \ReflectionClass($policy);
        $docComment = $reflection->getDocComment();

        if ($docComment) {
            preg_match('/@PolicyName\((.*?)\)/', $docComment, $matches);
            if (isset($matches[1])) {
                $policyNamesString = $matches[1];
                $policyNamesArray = [];
                preg_match_all('/(\w+)="([^"]+)"/', $policyNamesString, $nameMatches, PREG_SET_ORDER);
                foreach ($nameMatches as $nameMatch) {
                    $policyNamesArray[$nameMatch[1]] = $nameMatch[2];
                }
                return $policyNamesArray;
            }
        }

        return [];
    }
}
