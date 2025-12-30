<script>
    (function() {
        let rowIndex = document.querySelectorAll('#supplier-items-table tbody tr').length || 0;

        function filterProducts(row) {
            const typeSelect = row.querySelector('.supplier-item-type-filter');
            const puritySelect = row.querySelector('.supplier-item-purity-filter');
            const productSelect = row.querySelector('.supplier-item-product-select');
            if (!productSelect) return;

            const typeId = typeSelect ? typeSelect.value : '';
            const purityId = puritySelect ? puritySelect.value : '';

            Array.from(productSelect.options).forEach(function(option) {
                if (!option.value) return; // skip placeholder
                const optType = option.dataset.typeId || '';
                const optPurity = option.dataset.purityId || '';

                const matchType = !typeId || optType === typeId;
                const matchPurity = !purityId || optPurity === purityId;

                option.hidden = !(matchType && matchPurity);
            });

            // Reset selection if current option is now hidden
            if (productSelect.selectedOptions.length) {
                const current = productSelect.selectedOptions[0];
                if (current.hidden) {
                    productSelect.value = '';
                }
            }
        }

        function recalcRowTotals(row) {
            const weight = parseFloat(row.querySelector('.item-weight')?.value || 0);
            const rate = parseFloat(row.querySelector('.item-rate')?.value || 0);
            const lineTotal = (weight * rate) || 0;
            const totalField = row.querySelector('.item-total');
            const totalDisplay = row.querySelector('.item-total-display');

            if (totalField) totalField.value = lineTotal.toFixed(2);
            if (totalDisplay) totalDisplay.textContent = lineTotal.toFixed(2);
        }

        function recalcBillAmount() {
            let sum = 0;
            document.querySelectorAll('#supplier-items-table tbody tr').forEach(function(row) {
                const total = parseFloat(row.querySelector('.item-total')?.value || 0);
                if (!isNaN(total)) {
                    sum += total;
                }
            });
            const billAmountInput = document.querySelector('input[name="bill_amount"]');
            if (billAmountInput) {
                billAmountInput.value = sum.toFixed(2);
            }
        }

        function attachRowEvents(row) {
            const typeFilter = row.querySelector('.supplier-item-type-filter');
            const purityFilter = row.querySelector('.supplier-item-purity-filter');
            const productSelect = row.querySelector('.supplier-item-product-select');

            if (typeFilter) {
                typeFilter.addEventListener('change', function() {
                    filterProducts(row);
                });
            }

            if (purityFilter) {
                purityFilter.addEventListener('change', function() {
                    filterProducts(row);
                });
            }

            if (productSelect) {
                productSelect.addEventListener('change', function() {
                    const selected = productSelect.selectedOptions[0];
                    if (!selected) return;
                    const rate = parseFloat(selected.dataset.rate || '0');
                    const rateInput = row.querySelector('.item-rate');
                    if (rateInput && !rateInput.value) {
                        rateInput.value = rate.toFixed(2);
                    }
                    recalcRowTotals(row);
                    recalcBillAmount();
                });
            }

            row.querySelectorAll('.item-weight, .item-rate').forEach(function(input) {
                input.addEventListener('input', function() {
                    recalcRowTotals(row);
                    recalcBillAmount();
                });
            });

            const removeBtn = row.querySelector('.remove-item-row');
            if (removeBtn) {
                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tbody = document.querySelector('#supplier-items-table tbody');
                    if (tbody && tbody.rows.length > 1) {
                        row.remove();
                        recalcBillAmount();
                    }
                });
            }

            // Apply initial filters based on existing selections (edit view)
            filterProducts(row);
            recalcRowTotals(row);
        }

        function addNewRow() {
            const tbody = document.querySelector('#supplier-items-table tbody');
            const template = document.getElementById('supplier-item-row-template');
            if (!tbody || !template) return;

            const clone = template.content.cloneNode(true);
            const row = clone.querySelector('tr');

            // Update name attributes with current index
            row.querySelectorAll('[data-name-template]').forEach(function(el) {
                const base = el.getAttribute('data-name-template');
                el.setAttribute('name', base.replace('__INDEX__', rowIndex));
            });

            tbody.appendChild(row);
            attachRowEvents(row);
            rowIndex++;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-supplier-item-row');
            if (addBtn) {
                addBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    addNewRow();
                });
            }

            // Attach events to any existing rows (edit view)
            document.querySelectorAll('#supplier-items-table tbody tr').forEach(function(row) {
                attachRowEvents(row);
            });

            // If no existing rows (create view), add the first one
            const existingRows = document.querySelectorAll('#supplier-items-table tbody tr').length;
            if (!existingRows) {
                addNewRow();
            } else {
                // Ensure bill_amount reflects existing items on edit
                recalcBillAmount();
            }
        });
    })();
</script>

