// (A) GET HTML FILE PICKER & TABLE
let picker = document.getElementById("demoPick"),
    table = document.getElementById("demoTable");

// (B) ON SELECTING CSV FILE
picker.onchange = () => {
  // (B1) REMOVE OLD TABLE ROWS
  table.innerHTML = "";

  // (B2) READ CSV & GENERATE TABLE
  let reader = new FileReader();
  reader.addEventListener("loadend", () => {
    let csv = reader.result.split("\r\n");
    for (let row of csv) {
      let tr = table.insertRow();
      for (let col of row.split(";")) {
        let td = tr.insertCell();
        td.innerHTML = col;
      }
    }
  });
  reader.readAsText(picker.files[0]);
};
