import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { LoginModule } from '../pages/login/login.module';
import { LayoutModule } from '../layout/layout.module';



@NgModule({
  declarations: [],
  exports: [
    HttpClientModule,
    LoginModule,
    LayoutModule
  ]
})
export class CoreModule { }
