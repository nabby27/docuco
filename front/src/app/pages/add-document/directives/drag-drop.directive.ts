import { Directive, Output, EventEmitter, HostBinding, HostListener } from '@angular/core';

@Directive({
  selector: '[appDragDrop]'
})
export class DragDropDirective {

  @Output() fileDropped = new EventEmitter<any>();

  @HostBinding('style.background-color') private background = '#e0e0e0';

  constructor() { }

  // Dragover Event
  @HostListener('dragover', ['$event']) dragOver(event) {
    event.preventDefault();
    event.stopPropagation();
    this.background = '#d0d0d0';
  }

  // Dragleave Event
  @HostListener('dragleave', ['$event']) public dragLeave(event) {
    event.preventDefault();
    event.stopPropagation();
    this.background = '#e0e0e0'
  }

  // Drop Event
  @HostListener('drop', ['$event']) public drop(event) {
    event.preventDefault();
    event.stopPropagation();
    this.background = '#e0e0e0';
    const file = event.dataTransfer.files[0];
    if (file) {
      this.fileDropped.emit(file);
    }
  }

}
