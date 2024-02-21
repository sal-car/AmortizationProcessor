import { Amortization } from "../types";

/* 
Sorts the items by the scheduled date property.
For now, it only has the option to sort it by earliest,
but "latest" can be easily added by flipping a with b.
*/
function sortByDate(option: string, items: Amortization[]): Amortization[] {
  if (option === "earliest") {
    const result = items.sort((a, b) => {
      return (
        new Date(a.schedule_date).getTime() -
        new Date(b.schedule_date).getTime()
      );
    });
    return [...result];
  } else {
    return items;
  }
}

/* 
Sorts the items so that items that has the given state will come first.
*/
function sortByState(state: string, items: Amortization[]): Amortization[] {
  const result = items.sort((a, b) => {
    if (a.state === state && b.state !== state) {
      console.log(a.state);
      return -1;
    }
    if (a.state !== state && b.state === state) {
      return 1;
    }
    return 0;
  });

  return [...result];
}

export { sortByDate, sortByState };
