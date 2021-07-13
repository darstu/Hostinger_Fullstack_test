<template>
  <div class="row">
    <!-- fix later -->
    <div class="col-4" v-for="(userCampaign, l) in getUserC(userID)" :key="l">
      <div v-for="(campaign, k) in getCampaign(userCampaign)" :key="k">
        <div v-if="campaign.delivery_date > currentDate()">
          <v-card
            max-width="325"
            min-height="280"
            elevation="11"
            outlined
            shaped
            style="position: relative"
          >
            <v-card-title style="text-align: center">
              {{ campaign.campaign_name }}
            </v-card-title>

            <v-card-text>
              <div>
                <v-rating
                  v-model="rating"
                  background-color="orange lighten-3"
                  color="orange"
                  readonly
                  :value="3.5"
                  half-increments
                  small
                  style="margin-left: 0"
                ></v-rating>
              </div>

              <div class="grey--text" style="right: 0px; margin-bottom: 5px">
                4.5 (413)
              </div>
              Items (quantity in gift box):
              <div class="row" style="margin-top: 5px">
                <div v-for="(citem, i) in getCItems(campaign)" :key="i">
                  <div v-for="(item, j) in getItems(citem)" :key="j">
                    {{ item.name }} {{ citem.gift_item_count }};
                  </div>
                </div>
              </div>
            </v-card-text>

            <v-card-actions>
              <div v-if="campaign.dispatch_date > currentDate()">
                <form action="../unsubscribe" method="POST">
                  <input name="_token" type="hidden" :value="csrf" />
                  <input
                    name="campaign_id"
                    type="hidden"
                    :value="campaign.id"
                  />
                  <v-btn class="unsubscribeButton" type="submit"
                    >Unsubscribe</v-btn
                  >
                </form>
              </div>
            </v-card-actions>
          </v-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    rating: 4.5,
    campaigns: [],
    citems: [],
    items: [],
    userCampaigns: [],
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    userID: document
      .querySelector('meta[name="user-id"]')
      .getAttribute("content"),
  }),
  methods: {
    currentDate() {
      const current = new Date();
      const date = `${current.getDate()}/${
        current.getMonth() + 1
      }/${current.getFullYear()}`;
      return date;
    },
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
    loadCItems() {
      axios
        .get("api/campaignItem")
        .then((response) => {
          this.citems = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadItems() {
      axios
        .get("api/item")
        .then((response) => {
          this.items = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadUserCampaigns() {
      axios
        .get("api/userCampaign")
        .then((response) => {
          this.userCampaigns = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCItems(campaign) {
      return this.citems.filter((g) => g.campaign_id === campaign.id);
    },
    getItems(citem) {
      return this.items.filter((g) => g.id === citem.gift_id);
    },
    getUserC(userID) {
      //   return this.userCampaigns.filter((g) => g.user_id === userID);
      return this.userCampaigns.filter((g) => g.user_id == userID);
    },
    getCampaign(userCampaign) {
      return this.campaigns.filter((g) => g.id === userCampaign.campaign_id);
    },
  },
  mounted() {
    this.loadCampaigns();
    this.loadCItems();
    this.loadItems();
    this.loadUserCampaigns();
  },
};
</script>
