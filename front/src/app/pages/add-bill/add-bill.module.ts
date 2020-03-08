import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddBillComponent } from './add-bill.component';
import { Routes, RouterModule } from '@angular/router';
import { MaterialModule } from 'src/app/shared/material/material.module';
import { MatFileUploadModule } from 'angular-material-fileupload';

const routes: Routes = [
    {
        path: '',
        component: AddBillComponent
    }
];

@NgModule({
    declarations: [
        AddBillComponent
    ],
    imports: [
        CommonModule,
        MaterialModule,
        MatFileUploadModule,
        RouterModule.forChild(routes)
    ]
})
export class AddBillModule { }
