import { Tag } from './tag';

export class Document {

  id: string;
  name: string;
  description: string;
  tags: Tag[];
  price: number;
  url: string;
  date_of_issue: string;

  constructor(obj: any) {
    this.id = obj.id;
    this.name = obj.name;
    this.description = obj.description;
    this.tags = obj.tags;
    this.price = obj.price;
    this.url = obj.url;
    this.date_of_issue = obj.date_of_issue;
  }

} 
