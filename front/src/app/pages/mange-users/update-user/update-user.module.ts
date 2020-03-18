import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { UpdateUserComponent } from './update-user.component';

const routes: Routes = [
  {
    path: '',
    component: UpdateUserComponent
  },
];

@NgModule({
  declarations: [
    UpdateUserComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    SpinnerModule,
    RouterModule.forChild(routes)
  ]
})
export class UpdateUserModule { }
