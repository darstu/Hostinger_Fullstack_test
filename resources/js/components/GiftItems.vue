<template>
  <div class="row col-12">
    <div><button class="allButton" v-on:click="add">Add item</button></div>
    <h5>Pick an item to edit or delete</h5>
    <div class="col-8" style="margin: auto; margin-top: 15px">
      <v-data-table
        :headers="headers"
        :items="citems"
        item-key="id"
        class="elevation-1"
        :search="search"
        @click:row="handleClick"
        :items-per-page="20"
      >
        <template v-slot:top>
          <v-text-field
            v-model="search"
            label="Search"
            class="mx-4"
          ></v-text-field>
        </template>
      </v-data-table>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    singleSelect: true,
    citems: [],
    search: "",
    selected: [],
    headers: [
      {
        text: "ID",
        align: "start",
        filterable: false,
        value: "id",
      },
      { text: "Item name", value: "name" },
      { text: "Units owned", value: "units_owned" },
      { text: "One unit price", value: "unit_price" },
    ],
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    userID: document
      .querySelector('meta[name="user-id"]')
      .getAttribute("content"),
  }),
  methods: {
    loadItems() {
      axios
        .get("api/item")
        .then((response) => {
          this.citems = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    handleClick(value) {
      //console.log(value.id);
      //axios.get("/editItem?q=" + value.id);
      window.location.href = `/editItem?q=${value.id}`;
      //this.$router.push({ name: "editItem", params: { param1: value } });
      //return this.$router.push({ name: "editItem", params: { param1: id } });
    },
    add() {
      window.location.href = `/createItems`;
    },
  },
  mounted() {
    this.loadItems();
  },
};
</script>
