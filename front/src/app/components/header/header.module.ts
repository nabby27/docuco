import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header.component';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { UserAccountModule } from '../user-account/user-account.module';



@NgModule({
  declarations: [
    HeaderComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    UserAccountModule
  ],
  exports: [
    HeaderComponent
  ]
})
export class HeaderModule { }
