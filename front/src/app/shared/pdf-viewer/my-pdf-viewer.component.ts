import { Component, Input, OnChanges } from '@angular/core';

@Component({
  selector: 'app-my-pdf-viewer',
  templateUrl: './my-pdf-viewer.component.html',
  styleUrls: ['./my-pdf-viewer.component.scss']
})
export class MyPdfViewerComponent implements OnChanges {

  @Input() file: File|string = null;
  fileSrc;

  constructor() { }

  ngOnChanges() {
    this.renderPdfView(this.file);
  }

  private renderPdfView(file) {
    if (typeof file === 'string') {
      this.fileSrc = file;
    } else {
      var reader: FileReader = new FileReader();
  
      reader.onload = (event: Event) => {
        this.fileSrc = reader.result;
      }
  
      reader.readAsArrayBuffer(file);
    }
  }

}
