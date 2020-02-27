import { NgModule } from '@angular/core';
import { HeaderModule } from '../components/header/header.module';
import { FooterModule } from '../components/footer/footer.module';
import { SidenavModule } from '../components/sidenav/sidenav.module';
import { DragAndDropDirective } from '../directives/drag-and-drop.directive';



@NgModule({
  declarations: [
    DragAndDropDirective
  ],
  exports: [
    HeaderModule,
    SidenavModule,
    FooterModule,
    DragAndDropDirective
  ]
})
export class CoreModule { }
