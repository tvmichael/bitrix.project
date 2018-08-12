

<script type="text/javascript">
	
// 77 delivery ----------------------------------------------------------
a:3:
{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:18:"CondIBProp:14:1198";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						i:1367;
					}
				}
			}
		}
	}
}
-----
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:1:{
		s:3:"All";
		s:3:"AND";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:2:{
			s:8:"CLASS_ID";
			s:15:"ActSaleDelivery";
			s:4:"DATA";
			a:3:{
				s:4:"Type";
				s:8:"Discount";
				s:5:"Value";
				d:100;
				s:4:"Unit";
				s:4:"Perc";
			}
		}
	}
}


// 11 gift  -----------------------------------------------------------
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:2:"OR";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:18:"CondIBProp:14:1029";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						s:4:"Riho";
					}
				}
			}
		}
	}
}

-----
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:1:{
		s:3:"All";
		s:3:"AND";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:13:"GiftCondGroup";
			s:4:"DATA";
			a:1:{
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:19:"GifterCondIBElement";
					s:4:"DATA";
					a:2:{
						s:4:"Type";
						s:3:"all";
						s:5:"Value";
						a:1:{
							i:0;
							i:98343;
						}
					}
				}
			}
		}
	}
}
function($arOrder)
{
	$salecond_0_0=function($row)	
	{
		return (((isset($row['CATALOG']['PROPERTY_1029_VALUE']) && in_array("Riho", $row['CATALOG']['PROPERTY_1029_VALUE']))));
	}; 

	return (((CSaleBasketFilter::ProductFilter($arOrder, $salecond_0_0)))); 
};

// 13 gift ----------------------------------------------------------------
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:2:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:2:"OR";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:16:"CondBsktFldPrice";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Great";
						s:5:"value";
						d:8000;
					}
				}
			}
		}
		i:1;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:18:"CondIBProp:14:1029";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						s:7:"Radaway";
					}
				}
			}
		}
	}
}

// 61 gift
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:2:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:18:"CondIBProp:14:1198";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						i:1388;
					}
				}
				i:1;
				a:2:{
					s:8:"CLASS_ID";
					s:16:"CondBsktFldPrice";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Great";
						s:5:"value";
						d:5999;
					}
				}
			}
		}
	}
}


//66 -------------------------------------------------------------------
 a:3:{
 	s:8:"CLASS_ID";
 	s:9:"CondGroup";
 	s:4:"DATA";
 	a:2:{
 		s:3:"All";
 		s:3:"AND";
 		s:4:"True";
 		s:4:"True";
 	}
 	s:8:"CHILDREN";
 	a:1:{
 		i:0;
 		a:3:{
 			s:8:"CLASS_ID";
 			s:20:"CondBsktProductGroup";
 			s:4:"DATA";
 			a:2:{
 				s:5:"Found";
 				s:5:"Found";
 				s:3:"All";
 				s:3:"AND";
 			}
 			s:8:"CHILDREN";
 			a:1:{
 				i:0;
 				a:3:{
 					s:8:"CLASS_ID";
 					s:16:"CondBsktSubGroup";
 					s:4:"DATA";
 					a:2:{
 						s:3:"All";
 						s:3:"AND";
 						s:4:"True";
 						s:4:"True";
 					}
 					s:8:"CHILDREN";
 					a:1:{
 						i:0;
 						a:2:{
 							s:8:"CLASS_ID";
 							s:18:"CondIBProp:14:1198";
 							s:4:"DATA";
 							a:2:{
 								s:5:"logic";
 								s:5:"Equal";
 								s:5:"value";
 								i:1381;
 							}
 						}
 					}
 				}
 			}
 		}
 	}
 }




// 48  condition (знижка) --------------------------------------------------
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:0:{

	}
}
-----
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:1:{
		s:3:"All";
		s:3:"AND";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:14:"ActSaleBsktGrp";
			s:4:"DATA";
			a:6:{
				s:4:"Type";
				s:8:"Discount";
				s:5:"Value";
				d:60;
				s:4:"Unit";
				s:4:"Perc";
				s:3:"Max";
				i:0;
				s:3:"All";
				s:3:"AND";
				s:4:"True";
				s:4:"True";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:96098;
						}
					}
				}
			}
		}
	}
}
</script>
<?php
function (&$arOrder)
{
	$saleact_0_0=function($row)
	{
		return (
			(isset($row['CATALOG']['PARENT_ID']) ? ((isset($row['CATALOG']['ID']) && 
				($row['CATALOG']['ID'] == 96098)) || 
				($row['CATALOG']['PARENT_ID'] == 96098)) : (isset($row['CATALOG']['ID']) && 
				($row['CATALOG']['ID'] == 96098))
			)
		);
	};

	\Bitrix\Sale\Discount\Actions::applyToBasket($arOrder, array ('VALUE' => -60.0, 'UNIT' => 'P', 'LIMIT_VALUE' => 0,), $saleact_0_0);};
?>


<script>
// 24  (знижка) ---------------------------------------------------
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:0:{

	}
}
-----
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:1:{
		s:3:"All";
		s:3:"AND";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:14:"ActSaleBsktGrp";
			s:4:"DATA";
			a:6:{
				s:4:"Type";
				s:8:"Discount";
				s:5:"Value";
				d:20;
				s:4:"Unit";
				s:4:"Perc";
				s:3:"Max";
				i:0;
				s:3:"All";
				s:2:"OR";
				s:4:"True";
				s:4:"True";
			}
			s:8:"CHILDREN";
			a:6:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:95451;
						}
					}
				}
				i:1;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:95453;
						}
					}
				}
				i:2;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:95455;
						}
					}
				}
				i:3;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:95450;
						}
					}
				}
				i:4;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:95452;
						}
					}
				}
				i:5;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:1:{
							i:0;
							i:95454;
						}
					}
				}
			}
		}
	}
}


</script>









































// PS
<script>
// 3
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:9:"CondGroup";
			s:4:"DATA";
			a:2:{
				s:3:"All";
				s:3:"AND";
				s:4:"True";
				s:4:"True";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:3:{
					s:8:"CLASS_ID";
					s:20:"CondBsktProductGroup";
					s:4:"DATA";
					a:2:{
						s:5:"Found";
						s:5:"Found";
						s:3:"All";
						s:3:"AND";
					}
					s:8:"CHILDREN";
					a:1:{
						i:0;
						a:2:{
							s:8:"CLASS_ID";
							s:10:"CondIBCode";
							s:4:"DATA";
							a:2:{
								s:5:"logic";
								s:5:"Equal";
								s:5:"value";
								s:20:"pants-striped-flight";
							}
						}
					}
				}
			}
		}
	}
}



// 4  -2товара
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:2:{
							i:0;
							i:6;
							i:1;
							i:23;
						}
					}
				}
			}
		}
	}
}


// 10
a:3:{
	s:8:"CLASS_ID";
	s:9:"CondGroup";
	s:4:"DATA";
	a:2:{
		s:3:"All";
		s:3:"AND";
		s:4:"True";
		s:4:"True";
	}
	s:8:"CHILDREN";
	a:1:{
		i:0;
		a:3:{
			s:8:"CLASS_ID";
			s:20:"CondBsktProductGroup";
			s:4:"DATA";
			a:2:{
				s:5:"Found";
				s:5:"Found";
				s:3:"All";
				s:3:"AND";
			}
			s:8:"CHILDREN";
			a:1:{
				i:0;
				a:2:{
					s:8:"CLASS_ID";
					s:13:"CondIBElement";
					s:4:"DATA";
					a:2:{
						s:5:"logic";
						s:5:"Equal";
						s:5:"value";
						a:5:{
							i:0;
							i:5;
							i:1;
							i:23;
							i:2;
							i:24;
							i:3;
							i:25;
							i:4;
							i:26;
						}
					}
				}
			}
		}
	}
}



</script>