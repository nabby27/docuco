import { BrowserModule } from '@angular/platform-browser';
import { NgModule, DEFAULT_CURRENCY_CODE } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { CoreModule } from './core/core.module';
import { MaterialModule } from './shared/material/material.module';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { TokenInterceptor } from './core/interceptors/token.interceptor';
import { registerLocaleData } from '@angular/common';
import localeEs from '@angular/common/locales/es';
import localeEsExtra from '@angular/common/locales/extra/es';

registerLocaleData(localeEs, 'es', localeEsExtra);

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    CoreModule,
    MaterialModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterceptor,
      multi: true,
    },
    {
      provide: DEFAULT_CURRENCY_CODE,
      useValue: 'es'
    }
  ],
  bootstrap: [
    AppComponent
  ]
})
export class AppModule { }
