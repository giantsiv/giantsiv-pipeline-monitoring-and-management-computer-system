function searchtable() {
  var input, filter, table, tr, td, i, txtValue, counter1 = 0, counter2 = 0, counter3 = 0;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  if(table = document.getElementById("contenttable")){
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  if(table1 = document.getElementById("contenttableuser1")){
    table1.style.display = "";
    tr = table1.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          counter1++;
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
    if(counter1 == 0){
      table1.style.display = "none";
    }
  }
  if(table2 = document.getElementById("contenttableuser2")){
    table2.style.display = "";
    tr = table2.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          counter2++;
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
    if(counter2 == 0){
      table2.style.display = "none";
    }
  }
  if(table3 = document.getElementById("contenttableuser3")){
    table3.style.display = "";
    tr = table3.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          counter3++;
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
    if(counter3 == 0){
      table3.style.display = "none";
    }
  }
  
}