export interface Document {

  id: string;
  name: string;
  description: string;
  tags: string[];
  price: number;
  url: string;
  date_of_issue: string;
  type: 'INCOME' | 'EXPENSE' | string;

} 
