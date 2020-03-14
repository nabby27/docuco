import { Tag } from './tag';

export interface Document {

  id: string;
  name: string;
  description: string;
  tags: Tag[];
  price: number;
  url: string;
  date_of_issue: string;

} 
