import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home.component';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { ListDocumentComponent } from './components/list-document/list-document.component';
import { PieChartComponent } from './components/pie-chart/pie-chart.component';
import { DialogModule } from 'src/app/shared/dialog/dialog.module';
import { GenericChartComponent } from './components/generic-chart/generic-chart.component';

const routes: Routes = [
  {
    path: '',
    component: HomeComponent
  }
];

@NgModule({
  declarations: [
    HomeComponent,
    ListDocumentComponent,
    GenericChartComponent,
    PieChartComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    SpinnerModule,
    DialogModule,
    RouterModule.forChild(routes)
  ]
})
export class HomeModule { }
