import { Directive, HostListener, EventEmitter, Output, HostBinding } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { FileHandle } from '../interfaces/file-handle';

@Directive({
    selector: '[appDragAndDrop]'
})
export class DragAndDropDirective {

    @Output() files: EventEmitter<FileHandle[]> = new EventEmitter();

    constructor(private sanitizer: DomSanitizer) { }

    @HostListener('dragover', ['$event']) public onDragOver(evt: DragEvent) {
        evt.preventDefault();
        evt.stopPropagation();
    }

    @HostListener('dragleave', ['$event']) public onDragLeave(evt: DragEvent) {
        evt.preventDefault();
        evt.stopPropagation();
    }

    @HostListener('drop', ['$event']) public onDrop(evt: DragEvent) {
        evt.preventDefault();
        evt.stopPropagation();

        const files: FileHandle[] = [];
        debugger
        for (const fileTransfer of evt.dataTransfer.files[Symbol.iterator]) {
            debugger
            const file = fileTransfer;
            const url = this.sanitizer.bypassSecurityTrustUrl(window.URL.createObjectURL(file));
            files.push({ file, url });
        }
        if (files.length > 0) {
            this.files.emit(files);
        }
    }
}
