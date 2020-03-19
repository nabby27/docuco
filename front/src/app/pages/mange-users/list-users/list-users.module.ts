import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { ListUsersComponent } from './list-users.component';
import { UserCardModule } from '../components/user-card/user-card.module';

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
    UserCardModule,
    RouterModule.forChild(routes)
  ]
})
export class ListUsersModule { }
