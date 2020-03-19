import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/commentlike/';

export default [
  <Route path="/comment_likes/create" component={Create} exact key="create" />,
  <Route path="/comment_likes/edit/:id" component={Update} exact key="update" />,
  <Route path="/comment_likes/show/:id" component={Show} exact key="show" />,
  <Route path="/comment_likes/" component={List} exact strict key="list" />,
  <Route path="/comment_likes/:page" component={List} exact strict key="page" />
];
