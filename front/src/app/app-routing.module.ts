import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LayoutComponent } from './layout/layout.component';
import { AuthGuard } from './core/guards/auth.guard';
import { HasPermissionToView } from './core/guards/has-permission-to-view.guard';
import { HasPermissionToEdit } from './core/guards/has-permission-to-edit.guard';
import { HasPermissionToAdmin } from './core/guards/has-permission-to-admin.guard';



const routes: Routes = [
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then(m => m.LoginModule),
    canActivate: [AuthGuard]
  },
  {
    path: '',
    component: LayoutComponent,
    canActivate: [AuthGuard],
    children: [
      {
        path: 'home',
        loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule),
        canActivate: [HasPermissionToView],
      },
      {
        path: 'add-document',
        loadChildren: () => import('./pages/add-document/add-document.module').then(m => m.AddDocumentModule),
        canActivate: [HasPermissionToEdit],
      },
      {
        path: 'update-document/:documentId',
        loadChildren: () => import('./pages/update-document/update-document.module').then(m => m.UpdateDocumentModule),
        canActivate: [HasPermissionToEdit],
      },
      {
        path: 'list-users',
        loadChildren: () => import('./pages/mange-users/list-users/list-users.module').then(m => m.ListUsersModule),
        canActivate: [HasPermissionToAdmin],
      },
      {
        path: 'update-users/:userId',
        loadChildren: () => import('./pages/mange-users/update-user/update-user.module').then(m => m.UpdateUserModule),
        canActivate: [HasPermissionToAdmin],
      },
      {
        path: 'create-user',
        loadChildren: () => import('./pages/mange-users/create-user/create-user.module').then(m => m.CreateUserModule),
        canActivate: [HasPermissionToAdmin],
      },
      {
        path: '',
        redirectTo: '/home',
        pathMatch: 'full'
      },
    ]
  },
  { path: '**', redirectTo: '/login', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
