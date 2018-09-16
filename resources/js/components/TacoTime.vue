<template>

  <div class="container">
    <div class="card text-center">
      <div class="card-header">
        Taco Tuesday!
      </div>
      <div class="card-body">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
              Registers
            </span>
          </div>
          <input v-model.number="registers" v-on:keypress="isNumber()" type="number" min="1" class="form-control" id="registers">
        </div>

        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <label class="input-group-text" for="new-todo">Add a line time:</label>
          </div>
          <input v-model.number="nextLineTime" v-on:keypress="isNumber()" type="number" min="1" id="next_line_time" class="form-control" placeholder="Enter a line time" aria-label="Enter a line time" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button v-on:click.prevent="addNewWaitTime" class="btn btn-outline-secondary" type="button" id="button-addon2">
              Add
            </button>
          </div>
        </div>

        <h6 v-if="lineTimes.length > 0">
          Entered Line Times
        </h6>
        <p v-else>
          Add lime times above to check times.
        </p>

        <ul class="list-group mb-3">
          <draggable v-model="lineTimes" :options="{animation:150}">
            <li v-for="(lineTime, index) in lineTimes" class="list-group-item d-flex justify-content-between align-items-center">
              {{ lineTime }}
              <span class="badge badge-danger badge-pill" v-on:click="removeWaitTime(index)">
                Remove
              </span>
            </li>
          </draggable>
        </ul>

        <button v-on:click="checkTacoTime()" class="btn btn-primary" id="submitTacoTime" :disabled="isSubmitDisabled">
          Check times
        </button>

      </div>
      <div class="card-footer text-muted">
        <div class="lead" id="waitTime">
          <span v-if="!resultTime">
            Taco Time
          </span>
          <span v-else>
            <span class="badge badge-success badge-pill" v-html="resultTime"></span> Minutes to complete all orders
          </span>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  import draggable from 'vuedraggable';

  export default {
    components: {
      draggable
    },
    data: function() {
      return  {
        nextLineTime: 1,
        lineTimes: [],
        registers: 1,
        resultTime: null
      }
    },
    mounted() {
     //
    },
    computed: {
      isSubmitDisabled() {
        let self = this;
        if (self.lineTimes.length > 0 && self.registers > 0) {
          return false;
        };
        return true;
      }
    },
    methods: {
      addNewWaitTime: function () {
        let self = this;
        if (self.nextLineTime > 0) {
          self.lineTimes.push(self.nextLineTime);
          self.nextLineTime = 1;
        }
      },
      isNumber: function(evt) {
        evt = (evt) ? evt : window.event;
        let charCode = (evt.which) ? evt.which : evt.keyCode;
        let evaluation = (charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46;
        if (!evaluation) {
          return true;
        }
        evt.preventDefault();
      },
      removeWaitTime: function(index) {
        this.lineTimes.splice(index, 1);
      },
      checkTacoTime: function() {
        let self = this;
        axios.post('/api/tacotime', {
          registers: self.registers,
          customers: self.lineTimes
        })
        .then(function (response) {
          self.resultTime = response.data.linetime;
        })
        .catch(function (error) {
          self.resultTime = error;
        });
      }
    }
  }
</script>
