if (document.getElementById("genba-attendance-table") && typeof simpleDatatables.DataTable !== 'undefined') {

    let multiSelect = true;
    let rowNavigation = false;
    let table = null;

    const resetTable = function () {
        if (table) {
            table.destroy();
        }

        const options = {
            columns: [
                { select: [5], sortable: false } // Disable sorting on the first column (index 0 and 6)
            ],
            perPage: 5,
            labels: {
                placeholder: "Cari...",
                searchTitle: "Cari Peserta",
                pageTitle: "Halaman {page}",
                perPage: "Item per halaman",
                noRows: "Tidak Ada Peserta",
                info: "Menampilkan {start} sampai {end} dari {rows} item",
                noResults: "Tidak Ada Peserta Yang Cocok",
            },
            rowRender: (row, tr, _index) => {
                if (!tr.attributes) {
                    tr.attributes = {};
                }
                if (!tr.attributes.class) {
                    tr.attributes.class = "";
                }
                if (row.selected) {
                    tr.attributes.class += " selected";
                } else {
                    tr.attributes.class = tr.attributes.class.replace(" selected", "");
                }
                return tr;
            }
        };
        if (rowNavigation) {
            options.rowNavigation = true;
            options.tabIndex = 1;
        }

        table = new simpleDatatables.DataTable("#genba-attendance-table", options);

        // Mark all rows as unselected
        table.data.data.forEach(data => {
            data.selected = false;
        });

        table.on("datatable.selectrow", (rowIndex, event) => {
            event.preventDefault();
            const row = table.data.data[rowIndex];
            if (row.selected) {
                row.selected = false;
            } else {
                if (!multiSelect) {
                    table.data.data.forEach(data => {
                        data.selected = false;
                    });
                }
                row.selected = true;
            }
            table.update();
        });
    };

    // Row navigation makes no sense on mobile, so we deactivate it and hide the checkbox.
    const isMobile = window.matchMedia("(any-pointer:coarse)").matches;
    if (isMobile) {
        rowNavigation = false;
    }

    resetTable();
}