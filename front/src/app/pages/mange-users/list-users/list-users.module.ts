import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { ListUsersComponent } from './list-users.component';

const routes: Routes = [
  {
    path: '',
    component: ListUsersComponent
  },
];

@NgModule({
  declarations: [
    ListUsersComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    SpinnerModule,
    RouterModule.forChild(routes)
  ]
})
export class ListUsersModule { }
