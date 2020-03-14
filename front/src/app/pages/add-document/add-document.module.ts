import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddDocumentComponent } from './add-document.component';
import { Routes, RouterModule } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { ReactiveFormsModule } from '@angular/forms';
import { DragDropDirective } from './directives/drag-drop.directive';

const routes: Routes = [
  {
    path: '',
    component: AddDocumentComponent
  }
];

@NgModule({
  declarations: [
    AddDocumentComponent,
    DragDropDirective
  ],
  imports: [
    CommonModule,
    MaterialModule,
    ReactiveFormsModule,
    RouterModule.forChild(routes)
  ]
})
export class AddDocumentModule { }
