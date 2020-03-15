import { Component, Input, OnChanges } from '@angular/core';

@Component({
  selector: 'app-pdf-viewer',
  templateUrl: './pdf-viewer.component.html',
  styleUrls: ['./pdf-viewer.component.scss']
})
export class PdfViewerComponent {

  @Input() file: string = null;

  constructor() { }

}
