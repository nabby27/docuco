import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UserAccountComponent } from './user-account.component';
import { MaterialModule } from 'src/app/shared/material/material.module';



@NgModule({
    declarations: [
        UserAccountComponent
    ],
    imports: [
        CommonModule,
        MaterialModule
    ],
    exports: [
        UserAccountComponent
    ]
})
export class UserAccountModule { }
