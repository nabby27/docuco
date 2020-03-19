import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { UserCardComponent } from './user-card.component';


@NgModule({
  declarations: [
    UserCardComponent
  ],
  imports: [
    CommonModule,
    MaterialModule
  ],
  exports: [
    UserCardComponent
  ]
})
export class UserCardModule { }
