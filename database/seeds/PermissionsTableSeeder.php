<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        $permissions = [
          [
            'name' => 'manage-gymie',
            'display_name' => 'Administrar Gym',
            'group_key' => 'Global',
          ],
          [
            'name' => 'view-dashboard-quick-stats',
            'display_name' => 'Ver estadísticas rápidas en el tablero',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'view-dashboard-charts',
            'display_name' => 'Ver gráficos en el tablero',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'view-dashboard-members-tab',
            'display_name' => 'Ver pestaña de miembros en el tablero',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'view-dashboard-enquiries-tab',
            'display_name' => 'Ver pestaña de llamadas en el tablero',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'add-member',
            'display_name' => 'Añadir miembro',
            'group_key' => 'Members',
          ],
          [
            'name' => 'view-member',
            'display_name' => 'Ver detalles de miembros',
            'group_key' => 'Members',
          ],
          [
            'name' => 'edit-member',
            'display_name' => 'Editar detalles de miembros',
            'group_key' => 'Members',
          ],
          [
            'name' => 'delete-member',
            'display_name' => 'Eliminar miembro',
            'group_key' => 'Members',
          ],
          [
            'name' => 'add-plan',
            'display_name' => 'Agregar planes',
            'group_key' => 'Plans',
          ],
          [
            'name' => 'view-plan',
            'display_name' => 'Ver detalles del plan',
            'group_key' => 'Plans',
          ],
          [
            'name' => 'edit-plan',
            'display_name' => 'Editar detalles del plan',
            'group_key' => 'Plans',
          ],
          [
            'name' => 'delete-plan',
            'display_name' => 'Eliminar planes',
            'group_key' => 'Plans',
          ],
          [
            'name' => 'add-subscription',
            'display_name' => 'Agregar suscripción',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'edit-subscription',
            'display_name' => 'Editar detalles de suscripción',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'renew-subscription',
            'display_name' => 'Renovar la suscripción',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'view-invoice',
            'display_name' => 'Mirar factura',
            'group_key' => 'Invoices',
          ],
          [
            'name' => 'add-payment',
            'display_name' => 'Agregar pagos',
            'group_key' => 'Payments',
          ],
          [
            'name' => 'view-subscription',
            'display_name' => 'Ver detalles de suscripción',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'view-payment',
            'display_name' => 'Ver detalles de pago',
            'group_key' => 'Payments',
          ],
          [
            'name' => 'edit-payment',
            'display_name' => 'Editar detalles de pago',
            'group_key' => 'Payments',
          ],
          [
            'name' => 'manage-members',
            'display_name' => 'Administrar miembros',
            'group_key' => 'Members',
          ],
          [
            'name' => 'manage-plans',
            'display_name' => 'Administrar planes',
            'group_key' => 'Plans',
          ],
          [
            'name' => 'manage-subscriptions',
            'display_name' => 'Administrar Suscripciones',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'manage-invoices',
            'display_name' => 'Gestionar facturas',
            'group_key' => 'Invoices',
          ],
          [
            'name' => 'manage-payments',
            'display_name' => 'Gestionar pagos',
            'group_key' => 'Payments',
          ],
          [
            'name' => 'manage-users',
            'display_name' => 'Administrar usuarios',
            'group_key' => 'Users',
          ],
          [
            'name' => 'add-enquiry',
            'display_name' => 'Añadir llamada',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'view-enquiry',
            'display_name' => 'Ver detalles de la llmadas',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'edit-enquiry',
            'display_name' => 'Editar detalles de la llamada',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'add-enquiry-followup',
            'display_name' => 'Añadir llamada de seguimiento',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'edit-enquiry-followup',
            'display_name' => 'Editar seguimiento de llamada',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'transfer-enquiry',
            'display_name' => 'llamada de transferencia',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'manage-enquiries',
            'display_name' => 'Gestionar consultas',
            'group_key' => 'Enquiries',
          ],
          [
            'name' => 'add-expense',
            'display_name' => 'Agregar gastos',
            'group_key' => 'Expenses',
          ],
          [
            'name' => 'view-expense',
            'display_name' => 'Ver detalles de gastos',
            'group_key' => 'Expenses',
          ],
          [
            'name' => 'edit-expense',
            'display_name' => 'Editar detalles de gastos',
            'group_key' => 'Expenses',
          ],
          [
            'name' => 'manage-expenses',
            'display_name' => 'Administrar gastos',
            'group_key' => 'Expenses',
          ],
          [
            'name' => 'add-expenseCategory',
            'display_name' => 'Agregar categoría de gastos',
            'group_key' => 'Expense Categories',
          ],
          [
            'name' => 'view-expenseCategory',
            'display_name' => 'Ver categorías de gastos',
            'group_key' => 'Expense Categories',
          ],
          [
            'name' => 'edit-expenseCategory',
            'display_name' => 'Editar detalles de categoría de gastos',
            'group_key' => 'Expense Categories',
          ],
          [
            'name' => 'delete-expenseCategory',
            'display_name' => 'Eliminar categoría de gastos',
            'group_key' => 'Expense Categories',
          ],
          [
            'name' => 'manage-expenseCategories',
            'display_name' => 'Administrar categorías de gastos',
            'group_key' => 'Expense Categories',
          ],
          [
            'name' => 'manage-settings',
            'display_name' => 'Administrar configuraciones',
            'group_key' => 'Global',
          ],
          [
            'name' => 'cancel-subscription',
            'display_name' => 'Cancelar suscripción',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'manage-services',
            'display_name' => 'Administrar servicios',
            'group_key' => 'Services',
          ],
          [
            'name' => 'add-service',
            'display_name' => 'Agregar servicios',
            'group_key' => 'Services',
          ],
          [
            'name' => 'edit-service',
            'display_name' => 'Editar detalles del servicio',
            'group_key' => 'Services',
          ],
          [
            'name' => 'view-service',
            'display_name' => 'Ver detalles del servicio',
            'group_key' => 'Services',
          ],
          [
            'name' => 'manage-sms',
            'display_name' => 'SMS de administrador',
            'group_key' => 'SMS',
          ],
          [
            'name' => 'pagehead-stats',
            'display_name' => 'Ver recuentos de encabezados de página',
            'group_key' => 'Global',
          ],
          [
            'name' => 'view-dashboard-expense-tab',
            'display_name' => 'Ver pestaña de gastos en el tablero',
            'group_key' => 'Dashboard',
          ],
          [
            'name' => 'print-invoice',
            'display_name' => 'Imprimir facturas',
            'group_key' => 'Invoices',
          ],
          [
            'name' => 'delete-invoice',
            'display_name' => 'Eliminar facturas',
            'group_key' => 'Invoices',
          ],
          [
            'name' => 'delete-subscription',
            'display_name' => 'Eliminar suscripciones',
            'group_key' => 'Subscriptions',
          ],
          [
            'name' => 'delete-payment',
            'display_name' => 'Eliminar transacciones de pago',
            'group_key' => 'Payments',
          ],
          [
            'name' => 'delete-expense',
            'display_name' => 'Eliminar detalles de gastos',
            'group_key' => 'Expenses',
          ],
          [
            'name' => 'delete-service',
            'display_name' => 'Eliminar detalles del servicio',
            'group_key' => 'Services',
          ],
          [
            'name' => 'add-discount',
            'display_name' => 'Agregar descuento en una factura',
            'group_key' => 'Invoices',
          ],
          [
            'name' => 'change-subscription',
            'display_name' => 'Actualizar o degradar una suscripción',
            'group_key' => 'Subscriptions',
          ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
