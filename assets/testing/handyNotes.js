<uib-accordion-group is-open="status.open">
  <uib-accordion-heading>
      {{data.Text}} <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
  </uib-accordion-heading>
<div ng-repeat='member in members'>
  <p class="list-group-item-text" ng-click="assignMember(member.Username,data.TasksID)">{{member.Username}}</p>
</div>
</uib-accordion-group>
