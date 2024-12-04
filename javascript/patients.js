// //------------- To be seperated --------------------------------------------------
// // ------------------------------------- Handle the tabs  -------------------------------------

// https://www.w3schools.com/howto/howto_js_full_page_tabs.asp
function openPage(pageName, elmnt) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("add-tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("add-tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    tablinks[i].style.color = "#eaeae8";
    tablinks[i].style.fontWeight = "500";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = "#eaeae8";
  elmnt.style.color = "#0D1B2A";
  elmnt.style.fontWeight = "600";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

// ------------------------------------- Dynamically add addresses  -------------------------------------
// const add_address_button = document.getElementById("add-address-button");
// const addresses_container = document.getElementById("addresses-container");
// add_address_button.addEventListener("click", () => {
//   const newAddressWrapper = document.createElement("div");
//   newAddressWrapper.classList.add("with-trashbin");
//   const addressContainer = document.createElement("div");
//   addressContainer.classList.add("address-container");

//   const addressInput = document.createElement("input");
//   addressInput.type = "text";
//   addressInput.placeholder = "123 Any Street";
//   addressInput.required = true;

//   const countrySelect = document.createElement("select");
//   countrySelect.name = "country";
//   // countrySelect.onchange = fetchStates;
//   countrySelect.innerHTML = `<option value="">---Country---</option>`;

//   const stateSelect = document.createElement("select");
//   stateSelect.name = "state";
//   // stateSelect.onchange = fetchCities;
//   stateSelect.innerHTML = `<option value="">---State---</option>`;

//   const citySelect = document.createElement("select");
//   citySelect.name = "city";
//   // citySelect.onchange = showMap;
//   citySelect.innerHTML = `<option value="">---City---</option>`;

//   const trashIcon = document.createElement("ion-icon");
//   trashIcon.name = "trash";
//   trashIcon.addEventListener("click", () => {
//     addresses_container.removeChild(newAddressWrapper);
//   });

//   // Append all elements to their respective containers
//   addressContainer.appendChild(addressInput);
//   addressContainer.appendChild(countrySelect);
//   addressContainer.appendChild(stateSelect);
//   addressContainer.appendChild(citySelect);
//   newAddressWrapper.appendChild(addressContainer);
//   newAddressWrapper.appendChild(trashIcon);
//   // Append the new address wrapper to the addresses container
//   addresses_container.appendChild(newAddressWrapper);
// });

// ------------------------------------- Dynamically add examinations  -------------------------------------
// Add Examination Button
const addExaminationButton = document.getElementById("add-examination-button");
const examinationsContainer = document.getElementById("examinations-container");
addExaminationButton.addEventListener("click", () => {
  const examinationTemplate = `
            <div class="with-trashbin">
                <div class="examination-container">
                    <div class="Examinations-doctors">
                        <div id="examination-doctors-container">
                            <div class="with-trashbin">
                                <div class="examination-doctor-container">
                                    <input type="text" placeholder="Doctor" required>
                                </div>
                                <ion-icon name="trash" class="remove-doctor"></ion-icon>
                            </div>
                        </div>
                        <div class="add-button-wrapper">
                            <button type="button" class="add-button add-examination-doctor-button">+</button>
                        </div>
                    </div>
                    <input type="text" name="diagnosis" placeholder="Diagnosis" required>
                    <div class="Examinations-medications">
                        <div id="examination-medications-container">
                            <div class="with-trashbin">
                                <div class="examination-medication-container">
                                    <input type="text" placeholder="Medication" required>
                                </div>
                                <ion-icon name="trash" class="remove-medication"></ion-icon>
                            </div>
                        </div>
                        <div class="add-button-wrapper">
                            <button type="button" class="add-button add-examination-medication-button">+</button>
                        </div>
                    </div>
                    <input type="text" name="fee" class="fee" placeholder="Fee" required>
                    <div class="year-container">
                        <input type="date" name="date" title="Examination date" required>
                        <input type="date" name="next" title="Next examination date">
                    </div>
                </div>
                <ion-icon name="trash" class="remove-examination"></ion-icon>
            </div>
        `;
  examinationsContainer.insertAdjacentHTML("beforeend", examinationTemplate);

  // Add event listener to the new "Remove Examination" trash icon
  const removeExaminationIcons = document.querySelectorAll(".remove-examination");
  removeExaminationIcons.forEach((icon) => {
    icon.addEventListener("click", (e) => {
      e.target.closest(".with-trashbin").remove();
    });
  });

  // Add event listener to the new "Add Doctor" button
  const addExaminationDoctorButtons = document.querySelectorAll(".add-examination-doctor-button");
  addExaminationDoctorButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const doctorContainer = e.target.closest(".Examinations-doctors").querySelector("#examination-doctors-container");
      const doctorTemplate = `
                    <div class="with-trashbin">
                        <div class="examination-doctor-container">
                            <input type="text" placeholder="Doctor" required>
                        </div>
                        <ion-icon name="trash" class="remove-doctor"></ion-icon>
                    </div>
                `;
      doctorContainer.insertAdjacentHTML("beforeend", doctorTemplate);

      // Add event listener to new "Remove Doctor" trash icon
      const removeDoctorIcons = document.querySelectorAll(".remove-doctor");
      removeDoctorIcons.forEach((icon) => {
        icon.addEventListener("click", (e) => {
          e.target.closest(".with-trashbin").remove();
        });
      });
    });
  });

  // Add event listener to the new "Add Medication" button
  const addExaminationMedicationButtons = document.querySelectorAll(".add-examination-medication-button");
  addExaminationMedicationButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const medicationContainer = e.target.closest(".Examinations-medications").querySelector("#examination-medications-container");
      const medicationTemplate = `
                    <div class="with-trashbin">
                        <div class="examination-medication-container">
                            <input type="text" placeholder="Medication" required>
                        </div>
                        <ion-icon name="trash" class="remove-medication"></ion-icon>
                    </div>
                `;
      medicationContainer.insertAdjacentHTML("beforeend", medicationTemplate);

      // Add event listener to new "Remove Medication" trash icon
      const removeMedicationIcons = document.querySelectorAll(".remove-medication");
      removeMedicationIcons.forEach((icon) => {
        icon.addEventListener("click", (e) => {
          e.target.closest(".with-trashbin").remove();
        });
      });
    });
  });
});

// Initial event listener for existing "Remove Examination" buttons
const removeExaminationIcons = document.querySelectorAll(".remove-examination");
removeExaminationIcons.forEach((icon) => {
  icon.addEventListener("click", (e) => {
    e.target.closest(".with-trashbin").remove();
  });
});

// ------------------------------------- Dynamically add treatments  -------------------------------------
// Add Treatment Button
const addTreatmentButton = document.getElementById("add-treatment-button");
const treatmentsContainer = document.getElementById("treatments-container");

addTreatmentButton.addEventListener("click", () => {
  const treatmentTemplate = `
            <div class="with-trashbin">
                <div class="treatment-container">
                    <div class="Treatment-doctors">
                        <div id="treatment-doctors-container">
                            <div class="with-trashbin">
                                <div class="treatment-doctor-container">
                                    <input type="text" placeholder="Doctor" required>
                                </div>
                                <ion-icon name="trash" class="remove-doctor"></ion-icon>
                            </div>
                        </div>
                        <div class="add-button-wrapper">
                            <button type="button" class="add-button add-treatment-doctor-button">+</button>
                        </div>
                    </div>
                    <input type="text" name="result" placeholder="Result" required>
                    <div class="Treatment-medications">
                        <div id="treatment-medications-container">
                            <div class="with-trashbin">
                                <div class="treatment-medication-container">
                                    <input type="text" placeholder="Medication" required>
                                </div>
                                <ion-icon name="trash" class="remove-medication"></ion-icon>
                            </div>
                        </div>
                        <div class="add-button-wrapper">
                            <button type="button" class="add-button add-treatment-medication-button">+</button>
                        </div>
                    </div>
                    <div class="year-container">
                        <input type="date" name="start-treat" title="Start Date" required>
                        <input type="date" name="end-treat" title="End Date" required>
                    </div>
                    <select>
                        <option value="">State</option>
                        <option value="1">Recovered</option>
                        <option value="2">Not recovered</option>
                    </select>
                </div>
                <ion-icon name="trash" class="remove-treatment"></ion-icon>
            </div>
        `;
  treatmentsContainer.insertAdjacentHTML("beforeend", treatmentTemplate);

  // Add event listener to the new "Remove Treatment" trash icon
  const removeTreatmentIcons = document.querySelectorAll(".remove-treatment");
  removeTreatmentIcons.forEach((icon) => {
    icon.addEventListener("click", (e) => {
      e.target.closest(".with-trashbin").remove();
    });
  });

  // Add event listener to the new "Add Doctor" button
  const addTreatmentDoctorButtons = document.querySelectorAll(".add-treatment-doctor-button");
  addTreatmentDoctorButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const doctorContainer = e.target.closest(".Treatment-doctors").querySelector("#treatment-doctors-container");
      const doctorTemplate = `
                    <div class="with-trashbin">
                        <div class="treatment-doctor-container">
                            <input type="text" placeholder="Doctor" required>
                        </div>
                        <ion-icon name="trash" class="remove-doctor"></ion-icon>
                    </div>
                `;
      doctorContainer.insertAdjacentHTML("beforeend", doctorTemplate);

      // Add event listener to new "Remove Doctor" trash icon
      const removeDoctorIcons = document.querySelectorAll(".remove-doctor");
      removeDoctorIcons.forEach((icon) => {
        icon.addEventListener("click", (e) => {
          e.target.closest(".with-trashbin").remove();
        });
      });
    });
  });

  // Add event listener to the new "Add Medication" button
  const addExaminationMedicationButtons = document.querySelectorAll(".add-treatment-medication-button");
  addExaminationMedicationButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const medicationContainer = e.target.closest(".Treatment-medications").querySelector("#treatment-medications-container");
      const medicationTemplate = `
                    <div class="with-trashbin">
                        <div class="treatment-medication-container">
                            <input type="text" placeholder="Medication" required>
                        </div>
                        <ion-icon name="trash" class="remove-medication"></ion-icon>
                    </div>
                `;
      medicationContainer.insertAdjacentHTML("beforeend", medicationTemplate);

      // Add event listener to new "Remove Medication" trash icon
      const removeMedicationIcons = document.querySelectorAll(".remove-medication");
      removeMedicationIcons.forEach((icon) => {
        icon.addEventListener("click", (e) => {
          e.target.closest(".with-trashbin").remove();
        });
      });
    });
  });
});

// Initial event listener for existing "Remove Treatment" buttons
const removeTreatmentIcons = document.querySelectorAll(".remove-treatment");
removeTreatmentIcons.forEach((icon) => {
  icon.addEventListener("click", (e) => {
    e.target.closest(".with-trashbin").remove();
  });
});

// ------------------------------------- Inpatient / Outpatient visibility -------------------------------------
const patientSelector = document.querySelector("#patient-selector select");
const outpatientSections = document.querySelectorAll(".Examinations, .Outpatient-ID");
const inpatientSections = document.querySelectorAll(".DOA, .Nurse, .Sickroom, .DOD, .Fee, .Treatments, .Inpatient-ID");
function toggleSections() {
  const selectedValue = patientSelector.value;
  if (selectedValue === "1") {
    // Outpatient
    outpatientSections.forEach((section) => {
      section.style.display = "block";
    });
    inpatientSections.forEach((section) => {
      section.style.display = "none";
    });
  } else if (selectedValue === "2") {
    // Inpatient
    outpatientSections.forEach((section) => {
      section.style.display = "none";
    });
    inpatientSections.forEach((section) => {
      section.style.display = "block";
    });
  } else {
    // Default state: Hide all
    outpatientSections.forEach((section) => {
      section.style.display = "none";
    });
    inpatientSections.forEach((section) => {
      section.style.display = "none";
    });
  }
}
// Attach event listener
patientSelector.addEventListener("change", toggleSections);
// Initialize the visibility on page load
toggleSections();
