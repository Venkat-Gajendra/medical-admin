// Wait for the document to be ready before executing the code
document.addEventListener('DOMContentLoaded', () => {
  // Select the table element and initialize it with the tablesorter plugin
  const table = document.querySelector('table');
  tablesorter(table, { debug: true });
});

// Utility function to initialize the tablesorter plugin
const tablesorter = (table, options) => {
  // Use the jQuery version of the tablesorter plugin, if available
  if (window.jQuery && jQuery.fn.tablesorter) {
    jQuery(table).tablesorter(options);
  } else {
    console.error('The tablesorter plugin is not available');
  }
};
