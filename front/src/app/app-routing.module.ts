import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
    { path: 'login', loadChildren: () => import('./pages/login/login.module').then(m => m.LoginModule) },
    { path: 'home', loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule) },
    { path: 'add-document', loadChildren: () => import('./pages/add-document/add-document.module').then(m => m.AddDocumentModule) },
    { path: '', redirectTo: '/home', pathMatch: 'full' },
    { path: '**', redirectTo: '/home' }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
