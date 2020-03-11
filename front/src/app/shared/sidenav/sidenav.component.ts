import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-sidenav',
    templateUrl: './sidenav.component.html',
    styleUrls: ['./sidenav.component.scss']
})
export class SidenavComponent implements OnInit {

    links = [
        { text: 'INICIO', url: '/home', icon: 'dashboard' },
        { text: 'AÑADIR DOCUMENTO', url: '/add-document', icon: 'add_circle_outline' },
    ];

    constructor() {
    }

    ngOnInit() {

    }
}
