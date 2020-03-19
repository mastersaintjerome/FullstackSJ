import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/author/';

export default [
  <Route path="/authors/create" component={Create} exact key="create" />,
  <Route path="/authors/edit/:id" component={Update} exact key="update" />,
  <Route path="/authors/show/:id" component={Show} exact key="show" />,
  <Route path="/authors/" component={List} exact strict key="list" />,
  <Route path="/authors/:page" component={List} exact strict key="page" />
];
