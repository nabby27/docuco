import { Component, OnInit } from '@angular/core';
// import { FileHandle } from 'src/app/interfaces/file-handle';

@Component({
    selector: 'app-add-bill',
    templateUrl: './add-bill.component.html',
    styleUrls: ['./add-bill.component.scss']
})
export class AddBillComponent implements OnInit {

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
