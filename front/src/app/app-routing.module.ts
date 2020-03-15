import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LayoutComponent } from './layout/layout.component';
import { AuthGuard } from './core/guards/auth.guard';
import { NotViewGuard } from './core/guards/not-view.guard';



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
      },
      {
        path: 'add-document',
        loadChildren: () => import('./pages/add-document/add-document.module').then(m => m.AddDocumentModule),
        canActivate: [NotViewGuard],
      },
      {
        path: 'update-document/:documentId',
        loadChildren: () => import('./pages/update-document/update-document.module').then(m => m.UpdateDocumentModule),
        canActivate: [NotViewGuard],
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
