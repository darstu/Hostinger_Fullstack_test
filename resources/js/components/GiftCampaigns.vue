<template>
  <div class="row col-12">
    <div><button class="allButton" v-on:click="add">Add Campaign</button></div>
    <h5>Pick a campaign to edit or delete</h5>
    <div class="col-8" style="margin: auto; margin-top: 15px">
      <v-data-table
        :headers="headers"
        :items="campaigns"
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
    campaigns: [],
    search: "",
    selected: [],
    headers: [
      {
        text: "ID",
        align: "start",
        filterable: false,
        value: "id",
      },
      { text: "Campaign name", value: "campaign_name" },
      { text: "Status", value: "status" },
      { text: "Dispatch date", value: "dispatch_date" },
      { text: "Delivery date", value: "delivery_date" },
    ],
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    userID: document
      .querySelector('meta[name="user-id"]')
      .getAttribute("content"),
  }),
  methods: {
    loadCampaigns() {
      axios
        .get("api/campaign")
        .then((response) => {
          this.campaigns = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    handleClick(value) {
      window.location.href = `/editCampaign?q=${value.id}`;
    },
    add() {
      window.location.href = `/createCampaign`;
    },
  },
  mounted() {
    this.loadCampaigns();
  },
};
</script>
