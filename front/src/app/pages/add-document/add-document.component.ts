import { Component, OnInit } from '@angular/core';
import { FormGroup } from '@angular/forms';
// import { FileHandle } from 'src/app/interfaces/file-handle';

@Component({
  selector: 'app-add-document',
  templateUrl: './add-document.component.html',
  styleUrls: ['./add-document.component.scss']
})
export class AddDocumentComponent implements OnInit {

  documentFileForm: FormGroup;
  documentFile: File;

  constructor() { }

  ngOnInit() {
  }

  // filesDropped(files: FileHandle[]): void {
  //     this.files = files;
  // }

  upload(): void {
    //get image upload file obj;
  }

}
