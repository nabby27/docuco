import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddDocumentComponent } from './add-document.component';
import { Routes, RouterModule } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';

const routes: Routes = [
  {
    path: '',
    component: AddDocumentComponent
  }
];

@NgModule({
  declarations: [
    AddDocumentComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    RouterModule.forChild(routes)
  ]
})
export class AddDocumentModule { }
