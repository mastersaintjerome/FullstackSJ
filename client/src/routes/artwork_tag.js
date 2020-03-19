import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/artwork_tag/';

export default [
  <Route path="/artwork__tags/create" component={Create} exact key="create" />,
  <Route path="/artwork__tags/edit/:id" component={Update} exact key="update" />,
  <Route path="/artwork__tags/show/:id" component={Show} exact key="show" />,
  <Route path="/artwork__tags/" component={List} exact strict key="list" />,
  <Route path="/artwork__tags/:page" component={List} exact strict key="page" />
];
