import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { HeaderModule } from '../shared/header/header.module';
import { SidenavModule } from '../shared/sidenav/sidenav.module';
import { FooterModule } from '../shared/footer/footer.module';



@NgModule({
    declarations: [],
    exports: [
        HttpClientModule,
        HeaderModule,
        SidenavModule,
        FooterModule
    ]
})
export class CoreModule { }
