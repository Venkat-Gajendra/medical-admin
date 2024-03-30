const spacer = "&nbsp; &nbsp; &nbsp; ";
const tableTips = [
  { table: "titles", add: "Website Details", numCols: 4, edit: 3 },
  { table: "links", add: "Links", numCols: 4, edit: 3 },
  { table: "blog_categories", add: "Blog categories", numCols: 3, edit: 3 },
  { table: "blogs", add: "Blogs", numCols: 3, edit: 3 },
  { table: "editors_choice", add: "Editors choice", numCols: 3, edit: 3 },
];

const tipDescriptions = {
  add: [
    "",
    spacer + "Allow all members of the group to add records to the '{add}' table. A member who adds a record to the table becomes the 'owner' of that record.",
  ],
  view: [
    "",
    spacer + "Prohibit all members of the group from viewing any record in the '{table}' table.",
    spacer + "Allow each member of the group to view only his own records in the '{table}' table.",
    spacer + "Allow each member of the group to view any record owned by any member of the group in the '{table}' table.",
    spacer + "Allow each member of the group to view all records in the '{table}' table.",
  ],
  edit: [
    "",
    spacer + "Prohibit all members of the group from modifying any record in the '{table}' table.",
    spacer + "Allow each member of the group to edit only his own records in the '{table}' table.",
    spacer + "Allow each member of the group to edit any record owned by any member of the group in the '{table}' table.",
    spacer + "Allow each member of the group to edit any records in the '{table}' table, regardless of their owner.",
  ],
  delete: [
    "",
    spacer + "Prohibit all members of the group from deleting any record in the '{table}' table.",
    spacer + "Allow each member of the group to delete only his own records in the '{table}' table.",
    spacer + "Allow each member of the group to delete any record owned by any member of the group in the '{table}' table.",
    spacer + "Allow each member of the group to delete any records in the '{table}' table.",
  ],
};

const toolTipStyle = [
  "white",
  "#00008B",
  "#000099",
  "#E6E6FA",
  "",
  "images/helpBg.gif",
  "",
  "",
  "\"Trebuchet MS\", sans-serif",
  "",
  "",
  "",
  "3",
  400,
  "",
  1,
  2,
  10,
  10,
  51,
  1,
  0,
  "",
  "",
];

function createTip(type, num) {
  const tip = tipDescriptions[type].slice(1);
  for (let i = 1; i < numCols; i++) {
    tip.push(tip[0].replace("{" + type + "}", tipDescriptions[type][i]));
  }
  return tip;
}

const numCols = 4;
const tableTipArray = tableTips.flatMap((table) => {
  const tableName = table.add;
  const numRows = table.numCols;
  const tipArray = [];
  for (let i = 0; i < numRows; i++) {
    tipArray.push(createTip(i ? "view" : "add", numCols));
  }
  for (let i = 0; i < numRows; i++) {
    tipArray.push(createTip(i ? "edit" : "add", numCols));
  }
  for (let i = 0; i < numRows; i++) {
    tipArray.push(createTip(i ? "delete" : "add", numCols));
  }
  return tipArray;
});

const notifyAdminNewMembersTip = [
  "",
  spacer + "No email notifications to admin.",
  spacer + "Notify admin only when a new member is waiting for approval.",
  spacer + "Notify admin for all new sign-ups.",
];

const visitorSignupTip = [
  "",
  spacer + "Visitors will not be able to join this group unless the admin manually moves them to this group from the admin area.",
  spacer + "Visitors can join this group but will not be able to sign in unless the admin approves them from the admin area.",
  spacer + "Visitors can join this group and will be able to sign in instantly with no need for admin approval.",
];

function applyCssFilter() {
  // Implement the applyCssFilter function here
}

applyCssFilter();
