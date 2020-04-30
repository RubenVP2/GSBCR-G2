export class Medicament {
  idMed: string;
  nomCommercial: string;
  famille: string;
  composition: string;
  effet: string;
  contreIndication: string;

  // tslint:disable-next-line:ban-types
  constructor(values: Object = {}) {
    Object.assign(this, values);
  }
}
