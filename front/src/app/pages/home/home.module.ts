import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home.component';
import { RouterModule, Routes } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { SpinnerModule } from 'src/app/shared/spinner/spinner.module';
import { ListDocumentComponent } from './components/list-document/list-document.component';
import { BarChartComponent } from './components/bar-chart/bar-chart.component';
import { PieChartComponent } from './components/pie-chart/pie-chart.component';

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
    BarChartComponent,
    PieChartComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    SpinnerModule,
    RouterModule.forChild(routes)
  ]
})
export class HomeModule { }
