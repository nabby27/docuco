import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { UpdateUserComponent } from './update-user.component';
import { UserCardModule } from '../components/user-card/user-card.module';
import { UserFormComponent } from './components/user-form/user-form.component';
import { ReactiveFormsModule } from '@angular/forms';

const routes: Routes = [
  {
    path: '',
    component: UpdateUserComponent
  },
];

@NgModule({
  declarations: [
    UpdateUserComponent,
    UserFormComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    RouterModule.forChild(routes),
    MaterialModule,
    SpinnerModule,
    UserCardModule
  ]
})
export class UpdateUserModule { }
