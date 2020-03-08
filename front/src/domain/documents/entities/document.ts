import { Type } from "./type";

export class Document {

    id: string;
    name: string;
    description: string;
    types: Type[];
    price: number;
    url: string;
    date_of_issue: string;

    constructor(obj: any) {
        this.id = obj.id;
        this.name = obj.name;
        this.description = obj.description;
        this.types = obj.types;
        this.price = obj.price;
        this.url = obj.url;
        this.date_of_issue = obj.date_of_issue;
    }

}
