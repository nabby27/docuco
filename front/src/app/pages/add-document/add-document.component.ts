import { Component, OnInit } from '@angular/core';
// import { FileHandle } from 'src/app/interfaces/file-handle';

@Component({
    selector: 'app-add-document',
    templateUrl: './add-document.component.html',
    styleUrls: ['./add-document.component.scss']
})
export class AddDocumentComponent implements OnInit {

    files: any;

    constructor() { }

    ngOnInit() {
    }

    // filesDropped(files: FileHandle[]): void {
    //     debugger
    //     this.files = files;
    // }

    upload(): void {
        //get image upload file obj;
    }

}
