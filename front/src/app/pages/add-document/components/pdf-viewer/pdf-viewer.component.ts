import { Component, Input, OnChanges } from '@angular/core';

@Component({
  selector: 'app-pdf-viewer',
  templateUrl: './pdf-viewer.component.html',
  styleUrls: ['./pdf-viewer.component.scss']
})
export class PdfViewerComponent implements OnChanges {

  @Input() file: File = null;
  fileSrc;

  constructor() { }

  ngOnChanges() {
    this.renderPdfView(this.file);
  }

  private renderPdfView(file) {
    var reader: FileReader = new FileReader();

    reader.onload = (event: Event) => {
      this.fileSrc = reader.result;
    }

    reader.readAsArrayBuffer(file);
  }

}
