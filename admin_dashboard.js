function clearPopupArea() {
    document.getElementById('popup-area').innerHTML = "";
}


function loadTop10() {
    clearPopupArea();
    fetch('get_top_10.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('popup-area').innerHTML = data;
        })
        .catch(error => {
            document.getElementById('popup-area').innerHTML = `<p>Error: ${error.message}</p>`;
        });
}

function showDepartments() {
    clearPopupArea();
    const departments = ["CSE", "ICE", "CE", "EEE", "ELL", "BBA", "LLB", "ME"];
    const popup = document.getElementById("popup-area");

    const title = document.createElement("h3");
    title.textContent = "Select a Department";
    popup.appendChild(title);

    const buttonContainer = document.createElement("div");
    buttonContainer.id = "dept-buttons";

    departments.forEach(dept => {
        const btn = document.createElement("div");
        btn.className = "dept-button";
        btn.textContent = dept;
        btn.onclick = () => {
            
            fetch('get_department_usage.php?dept=' + dept)
                .then(response => response.text())
                .then(data => {
                    
                    const existing = document.getElementById("dept-result");
                    if (existing) existing.remove();

                    const result = document.createElement("div");
                    result.id = "dept-result";
                    result.innerHTML = data;
                    popup.appendChild(result);
                })
                .catch(error => {
                    popup.innerHTML = `<p>Error: ${error.message}</p>`;
                });
        };
        buttonContainer.appendChild(btn);
    });

    popup.appendChild(buttonContainer);
}


function showBatchInput() {
    clearPopupArea();
    const popup = document.getElementById("popup-area");

    const form = document.createElement("form");
    form.id = "batch-form";

    const label = document.createElement("label");
    label.htmlFor = "batch-input";
    label.innerHTML = "<strong>Enter Batch (13 - 20):</strong>";
    form.appendChild(label);

    const input = document.createElement("input");
    input.type = "number";
    input.id = "batch-input";
    input.name = "batch";
    input.min = "13";
    input.max = "20";
    input.required = true;
    form.appendChild(input);

    const button = document.createElement("button");
    button.type = "submit";
    button.id = "submit-batch";
    button.textContent = "Submit";
    form.appendChild(button);

    popup.appendChild(form);

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        const batch = document.getElementById("batch-input").value;

        fetch("get_batch_top10.php?batch=" + batch)
            .then(response => response.text())
            .then(data => {
                // FS
                const existing = document.getElementById("batch-result");
                if (existing) existing.remove();

                const result = document.createElement("div");
                result.id = "batch-result";
                result.innerHTML = data;
                popup.appendChild(result);
            })
            .catch(error => {
                popup.innerHTML = `<p>Error: ${error.message}</p>`;
            });
    });
}


function loadAllLogs() {
    clearPopupArea();
    fetch('get_all_logs.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('popup-area').innerHTML = data;
        })
        .catch(error => {
            document.getElementById('popup-area').innerHTML = `<p>Error: ${error.message}</p>`;
        });
}
