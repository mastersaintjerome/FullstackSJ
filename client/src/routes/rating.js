import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/rating/';

export default [
  <Route path="/ratings/create" component={Create} exact key="create" />,
  <Route path="/ratings/edit/:id" component={Update} exact key="update" />,
  <Route path="/ratings/show/:id" component={Show} exact key="show" />,
  <Route path="/ratings/" component={List} exact strict key="list" />,
  <Route path="/ratings/:page" component={List} exact strict key="page" />
];
