import { NgModule } from '@angular/core';
import {
  MatToolbarModule,
  MatIconModule,
  MatButtonModule,
  MatButtonToggleModule,
  MatSidenavModule,
  MatCardModule,
  MatMenuModule,
  MatProgressSpinnerModule
} from '@angular/material';



@NgModule({
  exports: [
    MatToolbarModule,
    MatIconModule,
    MatButtonModule,
    MatButtonToggleModule,
    MatSidenavModule,
    MatCardModule,
    MatMenuModule,
    MatProgressSpinnerModule
  ]
})
export class MaterialModule { }
